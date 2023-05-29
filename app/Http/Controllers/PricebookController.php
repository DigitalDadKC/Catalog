<?php

namespace App\Http\Controllers;

use view;
use App\Models\Pricebook;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use App\Http\Controllers\Controller;

class PricebookController extends Controller
{
    // Show all listings
    public function index(Request $request)
    {
        $search_filter = request()->query('search');
        $coop_filter = request()->query('filter-radio');
        $category_filter = request()->query('filter-checkbox');
        $discount = ($coop_filter) ? $this->get_discount(request()->query('filter-radio')) : 0;
        $categories = MaterialCategory::get();
        $cooperatives = Cooperative::get();
        return view(
            'references.pricebook',
            [
                'search_placeholder' => "Search Pricebook...",
                'materials' => Pricebook::query()->SearchFilter($search_filter)->CategoryFilter($category_filter)->paginate(30),
                'discount' => $discount,
                'cooperatives' => $cooperatives,
                'coop_filter' => $coop_filter,
                'categories' => $categories,
                'category_filter' => $category_filter
            ]
        );
    }

    public function fetch(Request $request)
    {
        if ($request->get('search')) {
            $query = $request->get('search');
            $materials = Pricebook::with('materialUnitSizes', 'materialCategories', 'materialStatuses')
                ->where('Name', 'LIKE', "%{$query}%")
                ->orWhere('SKU', 'Like', "%{$query}%")
                ->get();
            echo json_encode($materials);
        }
    }

    protected function get_discount($coop)
    {
        if ($coop == "BOOK") {
            $discount = 0;
        } else if ($coop == "AEPA" || $coop == "CES" || $coop == "ESCNJ" || $coop == "CMAS") {
            $discount = .134;
        } else if ($coop == "EI" || $coop == "IPHEC") {
            $discount = .133;
        } else if ($coop == "OMNIA") {
            $discount = .132;
        } else if ($coop == "KINETIC") {
            $discount = 0.12;
        } else {
            $discount = 1;
        }
        return $discount;
    }
}

// {
//     return view('listings.index', [
//         'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
//     ]);
// }