<tr>
    <td class="header" style="background-color: #3228c8">
        @if (trim($slot) === 'Laravel')
            <img src="https://aczxbt.stripocdn.email/content/guids/CABINET_f3abf9fc61a55a86828feb6372f25797/images/logocococo2_0E4.png"
                class="logo" alt="COCOCO Logo">
            {{--  <img src="{{ asset('img/logocococo.png') }}" class="logo" alt="COCOCO Logo"> --}}
        @else
            {{ $slot }}
        @endif
    </td>
</tr>
