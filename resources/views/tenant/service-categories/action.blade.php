<a href="{{ route('tenant.service-categories.edit', $category->id) }}" class="btn btn-info btn-sm">
    <i class="fas fa-edit"></i>
</a>
<form action="{{ route('tenant.service-categories.destroy', $category->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service category?')">
        <i class="fas fa-trash"></i>
    </button>
</form> 