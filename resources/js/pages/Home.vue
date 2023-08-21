<template>
    <div class="grid grid-cols-4 gap-1 p-2" style="background: ">
        <div class="forder-icon flex flex-col items-center" v-for="folder in folders">
            <img src="/images/icons/wiron.svg" style="max-width: 50%; max-height: 50%" />
            <p class="text-center mt-0.5" style="font-size: 60%; font-weight: 600">
                {{ folder.name }}
            </p>
        </div>
    </div>
    <div class="px-1 mt-4">
        <p class="px-2 mb-2" style="font-size: 95%; font-weight: 500">
            Recent File uploaded
        </p>
        <div class="file-item mt-0" style="display: flex" v-for="file in files">
            <div class="image-item pt-2" style="width: 52px;height 67px;background:;">
                <img :src="`/images/icons/${file.type}.svg`" />
            </div>
            <div class="pt-2 px-2" style="width: calc(100% - 80px); background: ">
                <p class="mt-1" style="font-size: 90%; font-weight: 600">
                    {{ file.name }}
                </p>
                <p class="mt-1" style="font-size: 85%; font-weight: 500; opacity: 0.5">
                    {{ file.created_at }}
                </p>
            </div>
            <div class="pt-2" style="width: 20px; height: 67px; background: ">
                <i class="fa fa-cloud-download text-blue-600 mt-1" aria-hidden="true"></i>
                <i class="fa fa-trash text-red-600 mt-2" aria-hidden="true" style="margin-left: 2px"></i>
            </div>
        </div>
    </div>
    <router-link :to="{name:'ForderCreate'}">
        <div class="text-center" style="
            width: 50px;
            height: 50px;
            background: blue;
            border-radius: 50%;
            position: fixed;
            right: 5px;
            bottom: 5vh;
        ">
            <i class="fa fa-folder-open" aria-hidden="true" style="font-size: 140%; line-height: 48px; color: white"></i>
        </div>
    </router-link>
</template>

<script>
export default {
    data() {
        return {
            folders: [],
            files: [],
        };
    },
    created: function (data) {
        this.getData();
    },
    methods: {
        async getData() {
            try {
                const {
                    data
                } = await axios.get("api/home/get-data");
                this.folders = data.folders;
                this.files = data.files;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style>
.forder-icon {
    cursor: pointer;
}

.forder-icon>img {
    width: 100%;
    height: auto;
}

.file-item {
    cursor: pointer;
}
</style>