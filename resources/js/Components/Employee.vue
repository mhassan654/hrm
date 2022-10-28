<script>

export default {
    props: {
        user: {
            type: {}
        },
    },

    data() {
        return {
            active: false,
        }
    },
}
</script>
<style>
</style>

<template>

<div class="media align-items-center mw-250">

    <div v-if="user !== null">
        <a href="{{ isset($disabledLink) ? 'javascript:;' : route('employees.show', [user.id]) }}" class="position-relative {{ isset($disabledLink) ? 'disabled-link' : '' }}">

                <span class="text-light-green position-absolute f-8 user-online" v-if="active"
                    title="@lang('modules.client.online')"><i class="fa fa-circle"></i>
                </span>

            <img :src="user.image_url " class="mr-2 taskEmployeeImg rounded-circle"
                :alt="user.name" :title="user.name">
        </a>
        <!-- <div class="media-body">
            <h5 class="mb-0 f-12">
                <a href="{{  isset($disabledLink) ? 'javascript:;' : route('employees.show', [$user->id]) }}"
                    class="text-darkest-grey {{ isset($disabledLink) ? 'disabled-link' : '' }}">{{ ucfirst($user->name) }}</a>
                @if (user() && user()->id == $user->id)
                    <span class="badge badge-secondary">@lang("app.itsYou")</span>
                @endif
            </h5>
            <p class="mb-0 f-12 text-dark-grey">
                {{ !is_null($user->employeeDetail) && !is_null($user->employeeDetail->designation) ? ucwords($user->employeeDetail->designation->name) : ' ' }}
            </p>
        </div> -->
    </div>
    <div v-else>
        ---
    </div>


</div>

</template>
