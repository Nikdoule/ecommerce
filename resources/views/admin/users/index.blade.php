@extends('layouts.app')

@section('users')
<div>
    <div>
        <div>
            <div class="card mt-5">
                <div class="card-header">Users list</div>
                <div class="card-body">
                    <table class="table-user  col-md-10">
                        @foreach ($users as $item)
                        <tbody class="d-flex justify-content-between">
                            <tr class="d-flex flex-column mb-5">

                                <td class="text-uppercase">
                                    @if ($item->image)
                                    <img src="{{asset('storage/' . $item->image)}}" alt="client-avatar"
                                        class="user-img">
                                    @endif
                                    {{ $item->name }}

                                </td>
                                <td><em class="text-muted"> {{ $item->email }}</em></td>
                                <td class="text-success">
                                    {{ implode(', ', $item->roles()->get()->pluck('name')->toArray()) }}</td>
                            </tr>
                            <td class="d-flex mt-4">
                                <a class="mr-1" href="{{ route('admin.users.edit',$item->id) }}"><img class="svg"
                                        src="/images/edit.svg" alt="bouton editer"></a>
                                @can('delete-users')
                                <form action="{{ route('admin.users.destroy',$item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-delete"><img class="svg " src="/images/stop.svg"
                                            alt="bouton supprimer"></button>
                                </form>
                                @endcan
                            </td>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
