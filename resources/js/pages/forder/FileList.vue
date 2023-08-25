<template>
    <div class="px-2">
        <div class="file-item mt-0" style="display: flex;" v-for="file in files">
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
</template>
<script>
export default {
    data() {
        return {
            files: []
        }
    },
    created: function () {
        this.getData();
    },
    methods: {
        async getData() {
            try {
                const { data } = await axios.get('/api/file/get-data/' + this.$route.params.id);
                this.files = data;
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>