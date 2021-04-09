@component('mail::message')
# Introduction

SAVEMART Application

<div> Your Have New Order :
 
    <br> @foreach ($data as $key => $value)

            {{ $key }} :
            {{ $value }}
            <br>

        @endforeach

</div>

Thanks,<br>

{{ config('app.name') }}
@endcomponent
