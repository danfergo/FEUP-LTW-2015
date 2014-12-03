<div id="poll-create">
    <script type="text/javascript">
        ERROR_MESSAGE = <?= json_encode($this->getErrorMsg()->getMessage()); ?>;
        OLD_POLL_DATA = <?= json_encode($this->getOldPoll()); ?>;
    </script>
</div>
