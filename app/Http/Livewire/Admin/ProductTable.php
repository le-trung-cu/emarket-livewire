<?php

namespace App\Http\Livewire\Admin;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\StoreBranch;
use Brick\Money\Money;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ProductTable extends PowerGridComponent
{
    use ActionButton;

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
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
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
     * @return Builder<\App\Models\Product>
     */
    public function datasource(): Builder
    {
        return Product::query()->with('storeBranch')->with('category')->withCount('skus')->with('variationOptions');
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
            ->addColumn('thumbnail', function (Product $product) {
                return view('components.admin.powergrid.product-table-thumbnail', [
                    'thumbnail' => $product->thumbnail,
                ]);
            })
            ->addColumn('name')
            ->addColumn('variant', function (Product $product) {
                $options = $product->variationOptions->map(fn ($item) => $item->name)->join(', ');
                return view('components.admin.powergrid.product-table-variant', [
                    'skus_count' =>  $product->skus_count,
                    'options' => $options,
                ]);
            })
            ->addColumn('storeBranch.name')
            ->addColumn('category.name')
            ->addColumn('regular_price', function (Product $product) {
                return Money::of($product->regular_price, 'VND');
            })
            ->addColumn('status', function (Product $product) {
                return view('components.admin.powergrid.product-table-status', [
                    'status' => ProductStatus::from($product->status)
                ]);
            })
            ->addColumn('created_at_formatted', fn (Product $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Product $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('actions', fn (Product $product) => view('components.admin.powergrid.product-table-actions', ['product' => $product]));
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
            Column::make('', 'thumbnail'),

            Column::make('NAME', 'name')
                ->bodyAttribute('text-sm')
                ->sortable(),

            Column::make('Variant', 'variant'),

            Column::make('CATEGORY', 'category.name')
                ->bodyAttribute('text-sm'),

            Column::make('PRICE', 'regular_price')
                ->bodyAttribute('text-sm')
                ->sortable()
                ->searchable(),

            Column::make('BRANCH', 'storeBranch.name')
                ->makeInputSelect(StoreBranch::all(), 'name', 'store_branch_id')
                ->sortable()
                ->hidden(true, false),

            Column::make('Status', 'status')
                ->sortable(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->bodyAttribute('text-sm')
                ->hidden(true, false)
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->bodyAttribute('text-sm')
                ->hidden(true, false)
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('Actions', 'actions')
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
     * PowerGrid Product Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('product.edit', ['product' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('product.destroy', ['product' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Product Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($product) => $product->id === 1)
                ->hide(),
        ];
    }
    */
}
