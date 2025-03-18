@extends('backend.app')

@section('content')
<div class="container" style="max-height: 60vh; overflow-y: auto;">
    <h3 class="fw-bold mb-3">Hasil Pencarian untuk: "{{ $query }}"</h3>

    <div class="row">
        {{-- Users Table --}}
        @if($users->isNotEmpty())
        <div class="col-md-12">
            <h4 class="text-dark p-2">Users</h4>
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        @foreach($users->first() as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at'])) {{-- Hilangkan kolom ini --}}
                                <th>{{ ucfirst($key) }}</th>
                            @endunless
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        @foreach($user as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at']))
                                @if($key === 'photo' && $value)
                                    <td>
                                        <img src="{{ asset('storage/' . $value) }}" width="50" height="50" class="rounded">
                                    </td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            @endunless
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        {{-- Students Table --}}
        @if($students->isNotEmpty())
        <div class="col-md-12">
            <h4 class="text-dark p-2">Students</h4>
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        @foreach($students->first() as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at']))
                                <th>{{ ucfirst($key) }}</th>
                            @endunless
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        @foreach($student as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at']))
                                @if($key === 'image' && !empty($value))
                                    <td>
                                        <img src="{{ asset('backend/images/' . $value) }}" width="50" height="50" class="rounded">
                                    </td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            @endunless
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        {{-- Teachers Table --}}
        @if($teachers->isNotEmpty())
        <div class="col-md-12">
            <h4 class="text-dark p-2">Teachers</h4>
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        @foreach($teachers->first() as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at']))
                                <th>{{ ucfirst($key) }}</th>
                            @endunless
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        @foreach($teacher as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at']))
                                @if($key === 'image' && !empty($value))
                                    <td>
                                        <img src="{{ asset('backend/images/' . $value) }}" width="50" height="50" class="rounded">
                                    </td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            @endunless
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection