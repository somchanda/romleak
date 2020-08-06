function confirmDialog(msg, myYes, myNo) {

    let alert = '<div class="alert-overlay">' +
        '        <div id="confirm">' +
        '            <div class="message"></div>' +
        '            <button class="yes button-small">Yes</button>' +
        '            <button class="no button-small-danger">No</button>' +
        '        </div>' +
        '    </div>';
    $('.padTop53').append(alert);
    var confirmBox = $("#confirm");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no").unbind().click(function() {
        confirmBox.hide();
        $('.alert-overlay').remove();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.find(".no").click(myNo);
    confirmBox.show();
}
