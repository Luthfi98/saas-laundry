<a href="{{ route('tenant.services.edit', ['code' => request()->route('code'), 'service' => $service->id]) }}" class="btn btn-info btn-sm">
    <i class="fas fa-edit"></i>
</a>
<form action="{{ route('tenant.services.destroy', ['code' => request()->route('code'), 'service' => $service->id]) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">
        <i class="fas fa-trash"></i>
    </button>
</form> 