<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){

            $columns = array(
                0 => 'name',

                1 => 'description',

                2 => 'created_at',
                3 => 'action',
            );

            $limit  = $request->input('length') ?? '-1';
            $start  = $request->input('start') ?? 0;
            $order  = $columns[$request->input('order.0.column')] ?? $columns[0];
            $dir    = $request->input('order.0.dir') ?? 'asc';
            $search = $request->input('search.value') ?? '';

            $query = \DB::table('roles as r')
                ->select(
                    'r.id',
                    'r.name',

                    'r.description',

                    'r.created_at',
                );
            $query->where(function($q) use($search){
                $q->where('r.name', 'like', $search . '%')

                    ->orWhere('r.description', 'like', $search . '%')

                    ->orWhere('r.created_at', 'like', $search . '%');
            });

            $totalData = $query->count();
            $query->orderBy($order, $dir);
            if ($limit != '-1') {
                $query->offset($start)->limit($limit);
            }
            $records = $query->get();
            $totalFiltered = $totalData;
            $data = array();
            if (isset($records)) {
                foreach ($records as $k => $v) {
                    $nestedData['id'] = $v->id;
                    $nestedData['name'] = $v->name;

                    $nestedData['description'] = $v->description;
                ;
                    $nestedData['created_at'] = \Carbon\Carbon::parse($v->created_at)->format('Y-m-d');
                    $nestedData['action'] = \View::make('Backend.roles._action')->with('row', $v)->render();;
                    $data[] = $nestedData;
                }
            }
            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            ], 200);
        }
        return view('Backend.roles.index');
    }

    public function create()
    {
        $role = new Role();
        return view('Backend.roles.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {

        Role::create([
            'name'                      => $request->input('name'),

            'description'                      => $request->input('description'),

        ]);
        return redirect()->route('roles.index')->with('successMsg','Successfully Created !!');
    }

    /**
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('Backend.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Role::where('id',$id)->update([
            'name'                      => $request->input('name'),

            'description'                      => $request->input('description'),

        ]);
        return redirect()->route('roles.index')->with('successMsg','Successfully Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        return response()->json([
            'message' => 'Role Successfully Deleted',
        ], 200);
    }
}



