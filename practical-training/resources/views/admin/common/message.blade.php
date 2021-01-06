{{-- 判断是否有success闪存 --}}
@if(session()->has('success'))
    <ul class="tip" style="color: #31c27c">
        <li>{{ session('success') }}</li>
    </ul>
@endif