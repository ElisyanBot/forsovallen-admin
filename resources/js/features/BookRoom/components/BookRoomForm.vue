<template>
    <div class="book-room-form__focus" >
        <form class="book-room-form">
            <div class="book-room-form__header">
                <h2> boka boende </h2>
                <button @click="$emit('closeBookForm')"> x </button>
            </div>
            <div class="text-info">
                <h3 class="book-room-form__second-header"> infomation </h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Quisque ligula erat, viverra eu urna a, porttitor elementum augue.
                    Ut nec dui suscipit, ullamcorper lacus vitae, interdum justo. Ut luctus iaculis tincidunt.
                    Sed fringilla tellus id ultricies sodales. Nullam finibus dignissim nisl eu posuere.
                    Vivamus vulputate leo vel ligula euismod auctor. Nulla eget pretium erat.
                </p>
            </div>
            <div class="room-info">
                <h3 class="book-room-form__second-header"> rum information </h3>
                <select class="input">
                    <option value="" disabled selected>Antal sängar</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                </select>
                <div class="two-input-container">
                    <input class="input" type="number" placeholder="antal vuxna" v-model.number="form"/>
                    <input class="input" type="number" placeholder="antal barn" v-model.number="form"/>
                </div>
            </div>
            <div class="contact-info">
                <h3 class="book-room-form__second-header"> konakt infomation </h3>
                <div class="two-input-container">
                    <input class="input" type="text" placeholder="namn" v-model="form"/>
                    <input class="input" type="text" placeholder="mobilnummer" v-model="form"/>
                </div>
                <input class="input" type="email" placeholder="email" v-model="form"/>
            </div>

            <div class="book-room-form__btn-container">
                <div class="importent-info">
                    <h4> OBS! </h4>
                    <p>
                        Vi skickar ut ett svar när rummet är bokat,
                        vi tar ej in mer uppgifter ifrån dig och all
                        betalning sker på plats.
                    </p>
                </div>
                <button class="book-room-form__button"> boka </button>
            </div>
        </form>
    </div>
</template>
<script setup>
    defineEmits(['closeBookForm']);
</script>

<style scoped lang="scss">
    .input {
        width: 100%;
        height: 5rem;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        font-size: 1.6rem;
        font-weight: bold;
        color: #464535;
        background-color: white;
        border: 1px solid black;

        &::placeholder {
            text-transform: capitalize;
        }
    }

    .two-input-container {
        display: flex;
        gap: 2rem;
    }

    .book-room-form__focus {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;


        .book-room-form {
            display: flex;
            flex-direction: column;
            gap: 4rem;
            width: 75rem;
            background-color: #f2f2f2;
            padding: 4rem;
            border-radius: 0.5rem;

            .book-room-form__header {
                text-transform: uppercase;
                width: 100%;
                font-size: 2.8rem;
                font-weight: bold;
                color: #1C4E46;
                display: flex;
                justify-content: space-between;

                button {
                    background-color: #f2f2f2;
                    width: 4.8rem;
                    height: 4.8rem;
                    border: none;
                    border-radius: 0.5rem;
                    padding: 1rem;
                    filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
                    color: #1C4E46;
                    font-size: 2.8rem;
                }
            }
            .book-room-form__second-header {
                text-transform: capitalize;
                margin-bottom: 1rem;
            }

            .book-room-form__btn-container {
                display: flex;
                justify-content: space-between;
                align-items: center;

                .importent-info {
                    width: 70%;
                    h4 {
                        color: #c64533;
                        margin-bottom: 0.5rem;
                    }
                    p {
                        font-weight: bold;
                        font-size: 1.4rem;
                    }
                }

                button {
                    color: white;
                    background-color: #7D9A89;
                    text-transform: uppercase;
                    font-size: 2rem;
                    font-weight: bold;

                    border: none;
                    width: 15rem;
                    height: 5rem;
                }
            }
        }
    }
</style>
