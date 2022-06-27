<?php

namespace App\Http\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class OrderTable extends PowerGridComponent
{
    use ActionButton;
    public string $orderStatus = 'all';
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
     * @return Builder<\App\Models\Order>
     */
    public function datasource(): Builder
    {
        return Order::query()
            ->when($this->orderStatus !== 'all', fn ($query) => $query->where('status', $this->orderStatus))
            ->with('buyer');
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
            ->addColumn('store_branch_id')
            ->addColumn('buyer_name', function (Order $order) {
                return $order->buyer?->name;
            })
            ->addColumn('group_id')
            ->addColumn('amount')
            ->addColumn('shipping_fee')
            ->addColumn('shipping_payment_type')
            ->addColumn('payment_type')
            ->addColumn('discount')
            ->addColumn('service_type_id_ghn')
            ->addColumn('recipient_name')
            ->addColumn('recipient_phone')
            ->addColumn('shipping_address')
            ->addColumn('ward_code')
            ->addColumn('district_id')
            ->addColumn('print_token_ghn')
            ->addColumn('status')
            ->addColumn('payment_status')
            ->addColumn('created_at_formatted', fn (Order $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Order $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'id')
                ->hidden(true, false),

            Column::make('STORE BRANCH ID', 'store_branch_id'),

            Column::make('BUYER NAME', 'buyer_name'),

            Column::make('GROUP ID', 'group_id')
                ->hidden(true, false),

            Column::make('AMOUNT', 'amount'),

            Column::make('SHIPPING FEE', 'shipping_fee')
                ->sortable(),

            Column::make('SHIPPING PAYMENT TYPE', 'shipping_payment_type')
                ->hidden(true, false),

            Column::make('PAYMENT TYPE', 'payment_type')
                ->sortable()
                ->hidden(true, false),

            Column::make('DISCOUNT', 'discount')
                ->sortable()
                ->hidden(true, false),

            Column::make('SERVICE TYPE ID GHN', 'service_type_id_ghn')
                ->sortable()
                ->hidden(true, false),

            Column::make('RECIPIENT NAME', 'recipient_name')
                ->sortable()
                ->searchable(),

            Column::make('RECIPIENT PHONE', 'recipient_phone')
                ->sortable()
                ->searchable()
                ->hidden(true, false),

            Column::make('SHIPPING ADDRESS', 'shipping_address')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(true, false),

            Column::make('WARD CODE', 'ward_code')
                ->hidden(true, false),

            Column::make('DISTRICT ID', 'district_id')
                ->hidden(true, false),

            Column::make('PRINT TOKEN GHN', 'print_token_ghn')
                ->hidden(true, false),

            Column::make('STATUS', 'status')
                ->sortable(),

            Column::make('PAYMENT STATUS', 'payment_status'),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->sortable()
                ->hidden(),
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
     * PowerGrid Order Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('order.edit', ['order' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('order.destroy', ['order' => 'id'])
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
     * PowerGrid Order Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($order) => $order->id === 1)
                ->hide(),
        ];
    }
    */
}
