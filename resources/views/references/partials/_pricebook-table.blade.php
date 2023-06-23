@props(['materials', 'pricebook', 'discount'])

<table class="table-auto">
    <thead class="w-full">
        <tr>
            <th>SKU</th>
            <th>Description</th>
            <th class="w-40">Units</th>
            <th class="w-52">Price</th>
            <th class="w-30">Status</th>
            <th class="w-30">Discountable</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody id="pricebook-table-body">
        @php
            $pb_column = $pricebook['pricebook_column'];
            $pb_status_column = $pricebook['pricebook_status_column'];
        @endphp
        <tr><td>{{$pb_column}}</td></tr>
        <tr><td>{{$pb_status_column}}</td></tr>
        @foreach($materials as $material)
            <tr class="odd:bg-gray-100">
                <td class="p-2">{{$material->SKU}}</td>
                <td class="p-2">{{$material->Name}}</td>
                <td class="p-2 text-center">{{$material->materialUnitSizes->Unit_Size}}</td>
                <td class="p-2 text-center">${{($material->$pb_column) ? number_format($material->$pb_column * (1-$discount), 2) : 0}}</td>
                {{-- <td class="p-2 text-center">{{($material->Price) ? ($material->Discountable) ? "$" . number_format($material->Price * (1-$discount), 2) : "$" . number_format($material->Price, 2) : "QUOTE"}}</td> --}}
                <td class="p-2 text-center">{{$material->$pb_status_column}}</td>
                {{-- <td class="p-2 text-center">{{optional($material->materialStatuses)->Status}}</td> --}}
                <td class="p-2 text-center">{{($material->Discountable) ? "Yes" : "No"}}</td>
                <td class="p-2 text-center">{{$material->materialCategories->Name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>