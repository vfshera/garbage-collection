<div class="session-messages-wrapper" x-data="{show: true}" x-init="setTimeout(() => show = false, 4500)" x-show="show">



    @if(session('success'))
    <div class="alert success">
        <i class="far fa-check-circle"></i>{{ session('success') }}
    </div>
    @endif



    @if(session('error'))
    <div class="alert error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif


</div>