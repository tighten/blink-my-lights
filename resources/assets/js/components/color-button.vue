<template>
    <div class="color-button" @mouseenter="hoverIn" @mouseleave="hoverOut">
        <div class="color-button__outer" :style="{ borderColor: hover ? css_value : 'transparent' }">
            <div class="color-button__inner" :style="{ backgroundColor: css_value }">
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .color-button {
        margin: 5px;

        &__inner {
            background-color: #cccccc;
            border-radius: 100%;
            cursor: pointer;
            height: 100%;
            opacity: .7;
            transition: all .2s;
            width: 100%;
        }

        &__outer {
            align-items: center;
            border-radius: 100%;
            border: 3px solid transparent;
            display: flex;
            height: 50px;
            justify-content: center;
            padding: 5px;
            transition: all .2s;
            width: 50px;
        }

        &:hover {
            .color-button__inner {
                opacity: 1;
            }

            .color-button__outer {
                border: 3px solid #cccccc;
            }
        }
    }
</style>

<script>
export default {
    props: {
        color: {},
        css_value: { default: '#cccccc'},
        label: {},
    },

    data() {
        return {
            hover: false,
        }
    },

    methods: {
        hoverIn() {
            this.hover = true;
        },
        hoverOut() {
            this.hover = false;
        },
    },
}
</script>
