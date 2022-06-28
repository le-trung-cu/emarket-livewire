<?php

namespace App\Http\Livewire\Admin;

use App\Models\SKU;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Detail, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SkuTable extends PowerGridComponent
{
    use ActionButton;

    public $weight, $price, $stock;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Detail::make()
                ->view('components.detail-sku')
                ->options(['name' => 'Luan'])
                ->showCollapseIcon(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\SKU>
     */
    public function datasource(): Builder
    {
        return SKU::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
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
                return $sku->variationValues->implode('value', ', ');
            })
            ->addColumn('activity')
            ->addColumn('weight')
            ->addColumn('price_format', fn($sku) => Blade::render('{{money}}', ['money' => $sku->price]))
            ->addColumn('stock')
            ->addColumn('created_at_formatted', fn (SKU $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (SKU $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('ACTIVITY', 'activity')
                ->makeBooleanFilter('activity', 'true', 'false')
                ->toggleable(),

            Column::make('WEIGHT', 'weight')

                ->editOnClick(),

            Column::make('PRICE', 'price_format', 'price')
                ->sortable()
                ->editOnClick(),

            Column::make('STOCK', 'stock')
                ->sortable()
                ->editOnClick(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->sortable(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid SKU Action Buttons.
     *
     * @return array<int, Button>
     */


    // public function actions(): array
    // {
    //    return [
    //        Button::make('edit', 'Edit')
    //            ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
    //            ->route('sku.edit', ['sku' => 'id']),

    //        Button::make('destroy', 'Delete')
    //            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
    //            ->route('sku.destroy', ['sku' => 'id'])
    //            ->method('delete')
    //     ];
    // }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid SKU Action Rules.
     *
     * @return array<int, RuleActions>
     */

    // public function actionRules(): array
    // {
    //    return [

    //        //Hide button edit for ID 1
    //         Rule::button('edit')
    //             ->when(fn($sku) => $sku->id === 1)
    //             ->hide(),
    //     ];
    // }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        // dd($id, $field, $value);
        SKU::query()->find($id)->update([
            $field => $value,
        ]);
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        SKU::query()->find($id)->update([
            'activity' => $value === "1" ? !true : !false,
        ]);
    }
}
