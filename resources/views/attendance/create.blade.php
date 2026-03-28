@extends('layouts.master')

@section('title', 'تسجيل الحضور')
@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5 class="mb-0">تسجيل حضور لكورس : {{ $session->course->name }}</h5>
                <div>
                    <span class="badge bg-light text-dark">{{ $session->date }}</span>
                    <span class="badge bg-light text-dark">{{ $session->time }}</span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('attendance.store', $session) }}" method="POST">
                    @csrf
                    <table id="attendanceTable" class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="30%">اسم الطالب</th>
                                <th width="30%">الهاتف</th>
                                <th width="30%" class="text-center">الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) }}"
                                            class="rounded-circle me-2" width="30">
                                        {{ $student->name }}
                                    </td>
                                    <td>{{ $student->phone }}</td>
                                    <td class="text-center">
                                        <!-- زر تبديل الحالة -->
                                        <div class="form-check form-switch d-inline-block">
                                            <input type="hidden" name="status[{{ $student->id }}]" value="absent">
                                            <input class="form-check-input" type="checkbox" id="student_{{ $student->id }}"
                                                name="status[{{ $student->id }}]" value="present"
                                                {{ ($attendances[$student->id]->status ?? 'absent') == 'present' ? 'checked' : '' }}
                                                style="width: 3em; height: 1.5em; cursor: pointer;"
                                                @if ($session->status == 'completed') disabled @endif>
                                            <label class="form-check-label ms-2" for="student_{{ $student->id }}">
                                                {{ ($attendances[$student->id]->status ?? 'absent') == 'present' ? 'حاضر' : 'غائب' }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($session->status == 'completed')
                        <div class="text-center mt-4">
                            <a href="{{ route('sessions.index') }}" class="btn btn-secondary btn-lg px-5"> عودة</a>
                        </div>
                    @else
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-5">حفظ الحضور</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#attendanceTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"
                },
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100]
            });

            // سكريبت لتحديث النص (حاضر/غائب) عند الضغط على التبديل
            $('.form-check-input').change(function() {
                var label = $(this).next('label');
                if ($(this).is(':checked')) {
                    label.text('حاضر');
                    label.addClass('text-success fw-bold');
                } else {
                    label.text('غائب');
                    label.removeClass('text-success fw-bold');
                }
            });

            $('.form-check-input').trigger('change');
        });
    </script>
@endsection
