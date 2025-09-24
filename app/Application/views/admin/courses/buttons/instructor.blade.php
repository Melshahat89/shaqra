@php
    $user = App\Application\Model\User::find($instructor_id);
@endphp

@if($user)
    {{ $user->fullname_lang }}
@else
    <span class="text-danger">مدرب غير موجود</span>
@endif
