<div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">

    <a href="{{ route('admin.customer.showcustomer', $role) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Shows">
        <i class="fas fa-eye"></i>
    </a>

        <a href="{{ route('admin.customer.get_customer_id', $role) }}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>

    <a href="{{ route('admin.customer.delete_customer', $role) }}"
       data-method="get"
       data-trans-button-cancel="@lang('buttons.general.cancel')"
       data-trans-button-confirm="@lang('buttons.general.crud.delete')"
       data-trans-title="@lang('strings.backend.general.are_you_sure')"
       class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
        <i class="fas fa-trash"></i>
    </a>
</div>
