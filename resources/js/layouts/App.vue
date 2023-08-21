<template>
    <div class="p-2 w-full">
        <div @click="$event => $router.go(-1)" class="pt2-2"
            style="width: 40px; height: 40px; float: left; cursor: pointer">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </div>
        <div class="pt-1" style="
                width: calc(100% - 100px);
                height: 40px;
                float: left;
                background: ;
            ">
            <p class="text-center mt-1 font-semibold">
                {{currentTitlePage}}
            </p>
        </div>

        <div class="pt-1 text-center" style="
                width: 40px;
                height: 40px;
                float: left;
                cursor: pointer;
                background: ;
                font-size: 130%;
            ">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
        <div style="clear: both"></div>
    </div>
    <router-view></router-view>
</template>
<script>
export default {
    data() {
        return {
            FormData: {
                name: ""
            }
        }
    },
    computed: {
        currentTitlePage() {
            return this.$route?.meta?.title || "";
        }
    }
}
</script>
