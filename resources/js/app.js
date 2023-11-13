import "./bootstrap";
import "./theme";
import "./fileUpload";

function toggleCheckedAttribute(element) {
    if (element.hasAttribute("checked")) {
        element.removeAttribute("checked");
    } else {
        element.setAttribute("checked", "checked");
    }
}
