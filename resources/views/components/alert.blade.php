@props([
'message' => 'これは初期メッセージです。',
'type' => 'success',
])

@php
function addClass($type){
$result = '';
switch($type){
case 'success' :
$result = 'bg-green-500';
break;
case 'info' :
$result = 'bg-blue-500';
break;
case 'alert' :
$result = 'bg-red-500';
break;
case 'warning' :
$result = 'bg-yellow-500';
break;
defalut:
$result = 'bg-green-200';
}
return $result;
}
@endphp

<div
     {{ $attributes->merge([
    'class'=>'flex justify-between p-4 items-center text-white ' . addClass($type) . ' text-white']) }}>
    <div>{{ $message }}</div>
    <button>x</button>
</div>