
{{--@can('update',\App\Models\Faq::class)--}}
    <a href="{{ route('roles.edit', $row->id) }}" class="btn btn-sm btn-info ml-1" title="{{ __('Update') }}"><i class="fas fa-pencil-alt"></i></a>
{{--@endcan--}}
{{--@can('destroy',\App\Models\Faq::class)--}}
    <button class="btn btn-sm btn-danger ml-1" onclick="confirmDelete(() => {deleteRole({{$row->id}})})"  title="{{ __('Destroy') }}"><i class="fas fa-trash"></i></button>
{{--@endcan--}}
