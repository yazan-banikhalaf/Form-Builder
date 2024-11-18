<?php

namespace App\Http\Controllers;

use App\Models\FormBuilder;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    public function index()
    {
        $forms = FormBuilder::all();
        return view("index", compact("forms"));
    }
    public function create()
    {
        return view("create");
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'form' => 'required',
        ]);

        $form = new FormBuilder();
        $form->name = $request->name;
        $form->content = $request->form;
        $form->save();

        return response()->json([
            'success' => true,
            'message' => 'Form added successfully',
        ]);
    }
    public function editData($id)
    {
        $form = FormBuilder::findOrFail($id);
        return view('edit', ['form' => $form]);
    }

    public function destroy(FormBuilder $form)
    {
       $form->delete();

       return redirect()->back()->with('success', 'Form deleted successfully');
    }
}
