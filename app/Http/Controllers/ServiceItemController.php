<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; use App\Repositories\Contracts\ServiceItemRepositoryInterface as Services;

class ServiceItemController extends Controller
{
    public function __construct(private Services $services){ $this->middleware('auth'); }
    public function index(){ $list=$this->services->paginate(); return view('services.index', compact('list')); }
    public function create(){ return view('services.create'); }
    public function store(Request $r){ $d=$r->validate(['name'=>'required','unit_price'=>'required|numeric','unit'=>'required']); $this->services->create($d); return redirect()->route('services.index'); }
    public function edit($id){ $item=$this->services->find($id); return view('services.edit', compact('item')); }
    public function update(Request $r,$id){ $item=$this->services->find($id); $d=$r->validate(['name'=>'required','unit_price'=>'required|numeric','unit'=>'required']); $this->services->update($item,$d); return redirect()->route('services.index'); }
    public function destroy($id){ $item=$this->services->find($id); $this->services->delete($item); return back(); }
}
