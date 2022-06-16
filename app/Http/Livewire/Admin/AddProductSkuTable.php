<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\SKU;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

use function PHPUnit\Framework\isEmpty;

final class AddProductSkuTable extends PowerGridComponent
{
    use ActionButton;
    public Product $product;
    public $options;
    public $nextVariationValuesCombinated;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'addSkusEvent',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {
        return collect($this->nextVariationValuesCombinated);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): array
    {
        $this->options = $this->product->variationOptions()->with('values')->get()->sortBy('id');

        $variationValuesDictionary = (array) collect($this->options)
            ->flatMap(fn ($option) => $option->values)
            ->reduce(function ($result, $item) {
                $result[$item->id] = $item;
                return  $result;
            }, []);

        // array has key is VariationOption's id and value is array VariationValue's id
        $optionValueDictionary = (array) collect($this->options)->reduce(function ($result, $option) {
            $result[$option->id] = $option->values->map(fn ($item) => $item->id)->toArray();
            return $result;
        }, []);

        $variationValuesCombinated = $this->combinateArrays([[]], ...array_values($optionValueDictionary));

        // [sku1, sku2]
        $skus = collect($this->product->skus()->with('variationValues')->get());

        if (count($skus) === 0) {
            $nextVariationValuesCombinated = $variationValuesCombinated;
            $variationValueIdsFromSkus = [[]];
        } else {

            // [[value1, value2], ]
            $variationValuesFromSkus = $skus->map(fn ($sku) => $sku->variationValues);
            // [[value1Id, value2Id], ]
            $variationValueIdsFromSkus = $variationValuesFromSkus->map(
                fn ($items) => $items->map(fn ($item) => $item->id)->toArray()
            )->toArray();

            $nextVariationValuesCombinated = array_filter($variationValuesCombinated, function ($item) use ($variationValueIdsFromSkus) {
                foreach ($variationValueIdsFromSkus as $value) {
                    if (count(array_diff($item, $value)) === 0) {
                        return false;
                    }
                }
                return true;
            });
        }

        $this->nextVariationValuesCombinated = collect($nextVariationValuesCombinated)
            ->map(
                function ($variationIds) use ($variationValuesDictionary) {
                    sort($variationIds, SORT_REGULAR);
                    $strVariationCombinated = implode('_', $variationIds);
                    $result = ['id' => $strVariationCombinated];
                    foreach ($variationIds as $id) {
                        $variationValue =  $variationValuesDictionary[$id];
                        $option = $this->options->find($variationValue->variation_option_id);
                        $result[$option->name] = [$id, $variationValue->value];
                    }
                    return $result;
                }
            );

        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
        ];
    }


    public function header(): array
    {
        return [
            Button::add('add-skus')
                ->caption(__('Add SKU'))
                ->class('wireui-button')
                ->emit('addSkusEvent', []),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        $grid = PowerGrid::eloquent()->addColumn('id');

        $this->options
            ->map(fn ($item) => $item->name)
            ->each(fn ($option) => $grid = $grid->addColumn($option, function ($row) use ($option) {
                return $row->{$option}[1];
            }));

        return $grid;
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |

    */
    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return collect($this->options)
            ->map(fn ($option) => Column::make($option->name, $option->name))
            ->toArray();
    }

    private function combinateArrays($array1, array ...$params)
    {
        if (count($params) === 1) {
            $result = [];
            foreach ($array1 as $value1) {
                foreach ($params[0] as $value2) {
                    $result[] = array(...$value1, $value2);
                }
            }
            return $result;
        }

        $result = $this->combinateArrays($array1, $params[0]);
        $result = $this->combinateArrays($result, ...array_splice($params, 1));
        return $result;
    }

    public function addSkusEvent()
    {
        if (count($this->checkboxValues) == 0) {
            $this->emit('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        DB::beginTransaction();
        try {
            $this->datasource()->each(function ($variationCombinated) {
                if (in_array($variationCombinated["id"], $this->checkboxValues)) {

                    $values = array_diff_key($variationCombinated, ["id" => null]);
                    foreach ($values as $optionName => $value) {
                        $valueIds[] = $value[0];
                    }

                    $sku = SKU::create([
                        'product_id' => $this->product->id,
                    ]);

                    $sku->variationValues()->sync($valueIds);
                }
            });
            DB::commit();
            $this->emitTo('admin.sku-manager', 'skuAddedEvent');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


        $this->dispatchBrowserEvent('showAlert', ['message' => 'You have selected IDs: ']);
    }
}
