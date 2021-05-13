console.log("Pulse from js loaded")

jQuery(document).ready(async function ($) {

    console.log("inside pulse");

    const challenge = getCookie("challenge");

    if (challenge) {
        // Initial pulse data
        let pulse = { debug: true };

        // Change default beat tick period
        wp.heartbeat.interval('fast'); // slow (1 beat every 60 seconds), standard (1 beat every 15 seconds), fast (1 beat every 5 seconds)

        // Initiate namespace with pulse data
        wp.heartbeat.enqueue('pulse', pulse, false);

        // Hook into the heartbeat-send
        jQuery(document).on('heartbeat-send.pulse', function (e, data) {

            // Send data to Heartbeat
            if (data.hasOwnProperty('pulse')) {
                data.pulse.challenge = challenge;
                if (data.pulse.debug === 'true') {

                    console.log('Data Sent: ');
                    console.log(data);
                    console.log('------------------');

                } // End If Statement

            } // End If Statement

        });
    } else {
        console.log("No need to start the polling since the challenge is not present");
    }


    // Listen for the custom event "heartbeat-tick" on $(document).
    jQuery(document).on('heartbeat-tick.pulse', function (e, data) {

        // Receive Data back from Heartbeat
        if (data.hasOwnProperty('pulse')) {

            if (data.pulse.debug === 'true') {

                console.log('Data Received: ');
                console.log(data);
                console.log('------------------');

            } // End If Statement

        } // End If Statement

        // Pass data back into namespace
        wp.heartbeat.enqueue('pulse', data.pulse, false);

    });

});