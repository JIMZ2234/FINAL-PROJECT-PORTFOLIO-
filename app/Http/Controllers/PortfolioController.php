<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private function rules(): array
    {
        return [
            'full_name'       => 'required|string|max:255',
            'profile_picture' => 'nullable|image|max:1024',
            'email'           => 'required|email|max:255',
            'contact_number'  => 'required|string|max:50',
            'address'         => 'required|string|max:255',
            'about'           => 'required|string',
            'education'       => 'nullable|string',
            'skills'          => 'nullable|string',
            'projects'        => 'nullable|string',
            'experience'      => 'nullable|string',
            'links'           => 'nullable|string',
        ];
    }

    private function encodePicture(Request $request): ?string
    {
        if (!$request->hasFile('profile_picture')) return null;
        $file = $request->file('profile_picture');
        return 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
    }

    // Stops users from opening someone else's portfolio
    private function authorizeOwner(Portfolio $portfolio): void
    {
        abort_unless((int) $portfolio->user_id === (int) auth()->id(), 403);
    }

    public function index(Request $request)
    {
        $portfolios = $request->user()->portfolios()->latest()->get();
        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        unset($data['profile_picture']);
        $data['profile_picture'] = $this->encodePicture($request);

        $portfolio = $request->user()->portfolios()->create($data);
        return redirect()->route('portfolios.templates', $portfolio)
            ->with('success', 'Portfolio saved to the online database. Now choose a template.');
    }

    public function show(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        $tpl = (int) $request->query('template', $portfolio->template);
        if (!in_array($tpl, [1, 2, 3])) $tpl = 1;
        return view('portfolios.show', compact('portfolio', 'tpl'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        $data = $request->validate($this->rules());
        unset($data['profile_picture']);
        if ($pic = $this->encodePicture($request)) {
            $data['profile_picture'] = $pic;
        }

        $portfolio->update($data);
        return redirect()->route('portfolios.templates', $portfolio)
            ->with('success', 'Portfolio updated.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        $portfolio->delete();
        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted.');
    }

    public function templates(Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        return view('portfolios.templates', compact('portfolio'));
    }

    public function selectTemplate(Request $request, Portfolio $portfolio)
    {
        $this->authorizeOwner($portfolio);
        $request->validate(['template' => 'required|in:1,2,3']);
        $portfolio->update(['template' => $request->template]);
        return redirect()->route('portfolios.show', $portfolio)->with('success', 'Template selected.');
    }
}