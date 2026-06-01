<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    BusinessDetail,
    about_us,
    heropage,
    our_partner,
    our_client,
    Feedback,
    portfolio,
    service,
    article,
    media,
    bank_detail
};

class UserController extends Controller
{
    // ===============================
    // ADMIN FUNCTIONALITY
    // ===============================

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'created_by' => auth()->id(),
              'access'     => 'unblock',
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function index()
    {
        $adminId = auth()->id();
        $users = User::where('created_by', $adminId)->get();
        return view('admin.users.index', compact('users'));
    }

    // ===============================
    // PUBLIC USER PAGES
    // ===============================

    /**
     * Homepage (username open karne par)
     */
    public function showByUsername($username)
    {
        $data = $this->getUserData($username);

        if ($data['aboutExists']) {
            return $this->showAbout($username);
        }

        if ($data['servicesExists']) {
            return $this->showServices($username);
        }

        if ($data['projectsExists']) {
            return $this->showProjects($username);
        }

        if ($data['visionaryExists']) {
            return $this->showVisionary($username);
        }

        if ($data['mediaExists']) {
            return $this->showMedia($username);
        }

        if ($data['bankExists']) {
            return $this->showBankDetail($username);
        }

        return $this->showContact($username);
    }

    /**
     * Helper: Fetch user data + section flags
     */
   private function getUserData($username)
{
    $user = User::where('username', $username)->firstOrFail();

    // ❌ Check if user is blocked
    if ($user->access === 'block') {
        abort(403, 'This user profile is not accessible.');
    }

    $userId = $user->id;
    $isPremium = $user->isPremiumActive();

    $about     = about_us::where('user_id', $userId)->first();
    $media     = media::where('user_id', $userId)->get();
    $services  = service::where('user_id', $userId)->get();
    $visionary = article::where('user_id', $userId)->get();
    $projects  = portfolio::where('user_id', $userId)->get();
    $bank      = bank_detail::where('user_id', $userId)->get();

    return [
        'user'       => $user,
        'isPremium'  => $isPremium,
        'username'   => $user->username,
        'details'    => BusinessDetail::where('user_id', $userId)->first(),
        'about_us'   => $about,
        'heropage'   => heropage::where('user_id', $userId)->get(),
        'partners'   => our_partner::where('user_id', $userId)->get(),
        'clients'    => our_client::where('user_id', $userId)->get(),
        'feedbacks'  => Feedback::where('user_id', $userId)->latest()->get(),
        'portfolios' => $projects,
        'services'   => $services,
        'visionary'  => $visionary,
        'bankdetails'=> $bank,
        'medias'     => $media,

        // ✅ Section Flags
        'aboutExists'    => !empty($about?->about_content) || !empty($about?->about_content2),
        'mediaExists'    => $media->isNotEmpty(),
        'servicesExists' => $services->isNotEmpty(),
        'visionaryExists'=> $visionary->isNotEmpty(),
        'projectsExists' => $projects->isNotEmpty(),
        'bankExists'     => $bank->isNotEmpty(),
    ];
}


    // ===============================
    // Pages
    // ===============================

    public function showAbout($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.about-us' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showServices($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.services' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showProjects($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.projects' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showVisionary($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.visionary' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showMedia($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.media' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showBankDetail($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.bank-detail' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showContact($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.contact' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }

    public function showShare($username)
    {
        $data = $this->getUserData($username);
        $view = $data['isPremium'] ? 'web.share' : 'nonpremium.nonpremium_teamplate';
        return view($view, $data);
    }
}
