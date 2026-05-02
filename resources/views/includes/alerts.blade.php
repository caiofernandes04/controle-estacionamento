@if(session('success'))

    <div class="success-message">
        {{ session('success') }}
    </div>

@endif


@if(session('error'))

    <div class="error-message">
        {{ session('error') }}
    </div>

@endif


@if(session('exits'))

    <div class="success-message">
        {{ session('exits') }}
    </div>

@endif


@if($errors->any())

    <div class="error-message">

        @foreach($errors->all() as $error)

            <div>
                {{ $error }}
            </div>

        @endforeach

    </div>

@endif