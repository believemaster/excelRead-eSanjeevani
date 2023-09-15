$("#table").DataTable({
    language: {
        emptyTable: "Data has been truncated successfully.",
    },
    paging: false,
});

function getMessage() {
    var range = document.createRange();
    range.selectNode(document.getElementById("factData"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges(); // to deselect

    toastr["success"]("Message Copied!")
}


