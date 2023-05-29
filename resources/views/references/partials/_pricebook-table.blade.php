@props(['materials', 'discount'])

<table class="table-auto">
    <thead class="w-full">
        <tr>
            <th>SKU</th>
            <th>Description</th>
            <th class="w-40">Units</th>
            <th class="w-52">Price</th>
            {{-- <th class="w-30">Status</th> --}}
            <th class="w-30">Discountable</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody id="pricebook-table-body">
        @forelse($materials as $material)
            <tr class="odd:bg-gray-100">
                    <td class="p-2">{{$material->SKU}}</td>
                    <td class="p-2">{{$material->Name}}</td>
                    <td class="p-2 text-center">{{$material->materialUnitSizes[0]->Unit_Size}}</td>
                    <td class="p-2 text-center">{{($material->Price) ? ($material->Discountable) ? "$" . number_format($material->Price * (1-$discount), 2) : "$" . number_format($material->Price) : "QUOTE"}}</td>
                    {{-- <td>{{(!optional($material->materialStatuses)[0]) ? "" : $material->materialStatuses[0]->Status}}</td> --}}
                    <td class="p-2 text-center">{{($material->Discountable) ? "Yes" : "No"}}</td>
                    <td class="p-2 text-center">{{$material->materialCategories[0]->Name}}</td>
            </tr>
        @empty
            <tr><th>No results found for query <strong>{{request()->query('search')}}</strong></th></tr>
        @endforelse
    </tbody>
</table>