<?php
namespace App\Http\Controllers;

use App\Models\media as Media;
use App\Models\User;

use App\Models\BusinessDetail;

class MediaController extends Controller
{
    public function index()
    {
        $details = BusinessDetail::where('user_id', auth()->id())->first();

        $medias = Media::all();
        return view('web.media', compact('details', 'medias'));
    }

    public function viewSingle($id)
    {
        $details = BusinessDetail::findOrFail($id);

        $medias = Media::findOrFail($id);

        // Sirf ek media item bhejna hai
        return view('web.media', [
            'details' => $details,
            'medias' => collect([$medias])
        ]);
    }

    public function showByUser($id)
    {
        $user = User::findOrFail($id);
        $medias = Media::where('user_id', $id)->get();

        return view('web.media', [
            'medias' => $medias,  
            'details' => $user,    
        ]);
    }
    
}
