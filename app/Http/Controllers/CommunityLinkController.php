<?php

namespace App\Http\Controllers;

use App\Filters\CommunityLinkFilter;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;

class CommunityLinkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel, CommunityLinkFilter $filters)
    {
        $links = $this->getLinks($channel, $filters);

//        $links = CommunityLink::forChannel($channel)->latest()->simplePaginate(15);

        return view('communities.index')->with(['links' => $links, 'channel' => $channel]);
    }

    protected function getLinks(Channel $channel, CommunityLinkFilter $filters)
    {
        $links = CommunityLink::with('channel')->latest()->filter($filters);

        if ($channel->exists) {
            $links->where('channel_id', $channel->id);
        }

        return $links->paginate(5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' => 'required|url|unique:community_links,link',
        ]);

        auth()->user()->communities()->create([
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'link' => $request->link,
        ]);

        return back();
    }
}
