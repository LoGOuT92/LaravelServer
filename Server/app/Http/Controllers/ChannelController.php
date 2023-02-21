<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = Channel::all();

        return response()->json([
            'channels' => $channels
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:40|min:1',
            'value' => 'required|integer|min:1',
        ]);
        $channel = new Channel;
        $channel->name = $validatedData['name'];
        $channel->value = $validatedData['value'];
        if ($channel->save()) {
            return response()->json([
                'message' => 'Channel created successfully',
                'channel' => $channel
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create channel'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'value' => 'required|integer'
        ]);

        $channel = Channel::find($id);

        if (!$channel) {
            return response()->json(['error' => 'Channel not found'], 404);
        }

        $channel->value = $validatedData['value'];

        if ($channel->save()) {
            return response()->json([
                'message' => 'Channel updated successfully',
                'channel' => $channel
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update channel'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $channel = Channel::find($id);

        if (!$channel) {
            return response()->json(['error' => 'Channel not found'], 404);
        }

        $channel->delete();

        return response()->json(['message' => 'Channel deleted successfully'], 200);
    }
}
