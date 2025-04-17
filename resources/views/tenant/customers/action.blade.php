<div class="btn-group">
    <a href="{{ route('tenant.customer.edit', ['code' => request()->route('code'), 'customer' => $customer->id]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
        <i class="fa-solid fa-pencil"></i>
    </a>
    <form id="delete-form-{{ $customer->id }}" action="{{ route('tenant.customer.destroy', ['code' => request()->route('code'), 'customer' => $customer->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <a href="#" onclick="showConfirm({{ $customer->id }})" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
        <i class="fa-solid fa-trash-can"></i>
    </a>
</div> 