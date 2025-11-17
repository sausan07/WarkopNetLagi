<div>
    @if($isFollowing)
        <button wire:click="toggleFollow" 
                class="text-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 text-[#373737] rounded-xl font-semibold transition-colors">
            Unfollow
        </button>
    @else
        <button wire:click="toggleFollow" 
                class="text-sm px-3 py-1 bg-[#F29F05] hover:bg-[#EB5160] text-white rounded-xl font-semibold transition-colors">
            Follow
        </button>
    @endif
</div>
