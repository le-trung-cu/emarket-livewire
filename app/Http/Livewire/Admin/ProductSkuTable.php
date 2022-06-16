<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\SKU;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ProductSkuTable extends PowerGridComponent
{
    use ActionButton;
    public $weight, $price, $stock, $barcode;
    public Product $product;
    public $options = [];

    // protected function getListeners(): array
    // {
    //     return array_merge(
    //         parent::getListeners(), 
    //         [
    //             '',
    //         ]);
    // }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): Builder
    {
        return $this->product->skus()->getQuery();
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
        $this->options = (array) collect($this->product->variationOptions)->reduce(function ($result, $item) {
            $result[$item->id] = [$item->name, $item->visual];
            return $result;
        }, []);

        $this->showCheckBox();

        return [
            
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
           
            Detail::make()
                ->view('components.admin.sku-variation-value-detail')
                ->options($this->options)
                ->showCollapseIcon(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('open-add-sku-modal')
                ->caption(__('Add SKU'))
                ->class('wireui-button')
                ->emitTo('admin.sku-manager', 'openAddSkuModalEvent', []),
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
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('variations', function (SKU $sku) {
                $result = collect($sku->variationValues)->reduce(function ($result, $item) {
                    $result[$this->options[$item->variation_option_id][0]] = $item->value;
                    return $result;
                }, []);
                return json_encode($result);
            })
            ->addColumn('barcode', function (SKU $sku) {
                return $sku->barcode ?? 'NULL';
            })
            ->addColumn('activity')
            ->addColumn('weight')
            ->addColumn('price')
            ->addColumn('stock');
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
        return [
            Column::make('ID', 'id'),

            Column::make('VARIATION', 'variations'),

            Column::make('BARCODE', 'barcode')
                ->sortable()
                ->editOnClick(),

            Column::make('ACTIVITY', 'activity')
                ->makeBooleanFilter('activity', 'true', 'false')
                ->toggleable(),

            Column::make('WEIGHT', 'weight')
                ->sortable()
                ->editOnClick(),

            Column::make('PRICE', 'price')
                ->sortable()
                ->editOnClick(),

            Column::make('STOCK', 'stock')
                ->sortable()
                ->editOnClick(),
        ];
    }

    public function actions(): array
    {
       return [
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->emitTo('admin.sku-manager', 'showConfirmDeleteSkuModalEvent', ['sku' => 'id'])
        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        $this->validate([
            'barcode.*' => 'string|unique:skus,barcode'
        ]);
        $value = strtoupper($value) === 'NULL' ? null : $value;
        SKU::query()->find($id)->update([
            $field => $value,
        ]);
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        SKU::query()->find($id)->update([
            $field => $value === "1" ? !true : !false,
        ]);
    }

    public function bulkActionEvent(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->emit('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(', ', $this->checkboxValues);

        $this->dispatchBrowserEvent('showAlert', ['message' => 'You have selected IDs: ' . $ids]);
    }


}
