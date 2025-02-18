<div class="md:hidden fixed bottom-0 w-full bg-black text-white">
    <!-- <div class="flex justify-around p-4"> -->
    <div class="grid grid-cols-4 p-4">
        <button @click="activeTab = 'businesses'" :class="{'bg-white text-black': activeTab === 'businesses'}" class="p-2 rounded-full hover:bg-white hover:text-black">
            <i class="fas fa-store"></i>
        </button>
        <button @click="activeTab = 'deals'" :class="{'bg-white text-black': activeTab === 'deals'}" class="p-2 rounded-full hover:bg-white hover:text-black">
            <i class="fas fa-tags"></i>
        </button>
        <button @click="activeTab = 'favorites'" :class="{'bg-white text-black': activeTab === 'favorites'}" class="p-2 rounded-full hover:bg-white hover:text-black">
            <i class="fas fa-heart"></i>
        </button>
        <button @click="activeTab = 'profile'" :class="{'bg-white text-black': activeTab === 'profile'}" class="p-2 rounded-full hover:bg-white hover:text-black">
            <i class="fas fa-user"></i>
        </button>
    </div>
</div>
