@props(['hotelId', 'user'])

@if($user)
    <a href="{{ route('book', ['hotelid' => $hotelId, 'custid' => $user->id]) }}" 
       {{ $attributes->merge(['class' => 'book-btn']) }}>
        {{ $slot ?? 'Book' }}
    </a>
@else
    <a href="{{route('login')}}" 
       {{ $attributes->merge(['class' => 'book-btn disabled']) }}
       onclick="promptLogin(event)">
        {{ $slot ?? 'Login to Book' }}
    </a>
@endif