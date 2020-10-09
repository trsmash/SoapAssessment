<template>
    <div class="booker">
        <div class="chat">
            <div class="container">
                <div class="msg-header">
                    <div class="active">
                        <h5>#General</h5>
                    </div>
                </div>

                <div class="chat-page">
                    <div class="msg-inbox">
                        <div class="chats" id="chats">
                            <div class="msg-page" id="msg-page">

                                <div
                                        v-if="loadingMessages"
                                        class="loading-messages-container"
                                >
                                    <spinner :size="100"/>
                                    <span class="loading-text">
                            Loading Messages
                          </span>
                                </div>
                                <div class="text-center img-fluid empty-chat" v-else-if="!groupMessages.length" >
                                    <div class="empty-chat-holder">
                                        <img src="#" class="img-res" alt="empty chat image">
                                    </div>

                                    <div>
                                        <h2> No new message? </h2>
                                        <h6 class="empty-chat-sub-title">
                                            Send your first message below.
                                        </h6>
                                    </div>
                                </div>

                                <div v-else>
                                    <div v-for="message in groupMessages" v-bind:key="message.id">
                                        <div class="received-chats" v-if="message.sender.uid !== uid">
                                            <div class="received-chats-img">
                                                <img v-bind:src="message.sender.avatar" alt="" class="avatar">
                                            </div>

                                            <div class="received-msg">
                                                <div class="received-msg-inbox">
                                                    <p><span>{{ message.sender.uid }}</span><br>{{ message.data.text }}</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="outgoing-chats" v-else>
                                            <div class="outgoing-chats-msg">
                                                <p>{{ message.data.text }}</p>
                                            </div>

                                            <div class="outgoing-chats-img">
                                                <img v-bind:src="message.sender.avatar" alt="" class="avatar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="msg-bottom">
                        <form class="message-form" v-on:submit.prevent="sendGroupMessage">
                            <div class="input-group">
                                <input type="text" class="form-control message-input" placeholder="Type something" v-model="chatMessage" required>
                                <spinner
                                        v-if="sendingMessage"
                                        class="sending-message-spinner"
                                        :size="30"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBar from "../components/NavBar.vue";
    import Spinner from "../components/Spinner.vue";

    export default {
        name: "home",
        components: {
            NavBar,
            Spinner
        },
        props: [
            'user'
        ],
        mounted() {
            axios.get(`api/channels/1/users/2/invite`)
                .then(response => console.log(response.data))
                .catch(error => console.error(error));
        },
        data() {
            return {
                username: "",
                avatar: "",
                uid: "",
                sendingMessage: false,
                chatMessage: "",
                loggingOut: false,
                groupMessages: [],
                loadingMessages: false
            };
        },
        created() {
            this.getLoggedInUser();
        },
        methods: {
            getLoggedInUser() {

            },
        }
    };
</script>