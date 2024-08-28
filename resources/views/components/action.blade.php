<div class="d-flex justify-content-center">
    <a href="{{ $editUrl }}" class="edit btn btn-primary btn-sm mr-3">Edit</a>
    @if (!request()->routeIs('reservations.index'))
        <form action="{{ $deleteUrl }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete btn btn-danger btn-sm">Delete</button>
        </form>

    @endif
</div>
