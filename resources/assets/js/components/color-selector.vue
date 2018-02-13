<template>
    <div class="color-container" :style="{ backgroundColor: blink_background }">
        <div v-for="group in colors" class="color-row">
            <color-button v-for="(css_value, color) in group"
                :color="color"
                :css_value="css_value"
                :key="color"
                @click.native="submitColor(css_value, color)"
            ></color-button>
        </div>

        <div class="color-row color-button__random" @click="submitRandom">
            <h3>Random</h3>
        </div>

        <p :class="error ? 'message--error' : 'message--success'">
            &nbsp;{{ message }}
        </p>
    </div>
</template>

<style lang="scss">
    .color-container {
        margin: 0 3em;
        padding: 3em;
        border-radius: 10px;
        transition: background-color .4s ease;
    }

    .color-row {
        align-items: center;
        justify-content: center;
        display: flex;
        flex-wrap: wrap;
    }

    .color-button__random {
        cursor: pointer;
        opacity: .7;
        transition: all .2s;

        &:hover {
            opacity: 1;
        }
    }

    .message--error {
        color: #b52f2f;
        font-weight: bold;
    }

    .message--success {
        color: #636b6f;
        font-weight: bold;
    }
</style>

<script>
import ColorButton from './color-button.vue';

export default {
    components: {
        ColorButton,
    },

    data() {
        return {
            blink_background: 'white',
            colors: {
                whites: {
                    'kelvin:8000': '#c9dee8', // Cold White
                    'kelvin:5000': '#e3edde', // Cool White
                    'kelvin:3500': '#ebebeb', // Medium White
                    'kelvin:3000': '#f2dbca', // Warm White
                    'kelvin:2700': '#fce4bf', // Hot White
                },
                saturated: {
                    red: '#ff0000',
                    orange: '#e69500',
                    yellow: '#f5ed00',
                    green: '#008000',
                    cyan: '#00ffff',
                    blue: '#0000ff',
                    purple: '#800080',
                    pink: '#ffadbb',
                },
                pastels: {
                    'red saturation:0.5': '#c98282',
                    'orange saturation:0.5': '#d1aa61',
                    'yellow saturation:0.5': '#f4ea80',
                    'green saturation:0.5': '#75a375',
                    'cyan saturation:0.5': '#70c2c2',
                    'blue saturation:0.5': '#707ec2',
                    'purple saturation:0.5': '#a375a3',
                    'pink saturation:0.5': '#dfb4bb',
                },
            },
            error: false,
            message: '',
        }
    },

    methods: {
        blinkBackground(css_value) {
            this.blink_background = css_value;
            setTimeout(() => {
                this.blink_background = 'white';
            }, 200)
        },
        submitColor(css_value, color) {
            this.blinkBackground(css_value);
            axios.post('/flash', { color: color }).then((response) => {
                this.error = false;
                this.message = response.data.message;
            }).catch((error) => {
                this.error = true;
                this.message = error.response.data.error;
            });
        },
        submitRandom() {
            let colors = Object.assign({}, this.colors.whites, this.colors.saturated, this.colors.pastels);
            let randomColor = this.getRandomColor(colors);
            this.submitColor(colors[randomColor], randomColor);
        },
        getRandomColor(colors) {
            let colorKeys = Object.keys(colors);
            return colorKeys[Math.floor(Math.random()*colorKeys.length)];
        }
    },
}
</script>
