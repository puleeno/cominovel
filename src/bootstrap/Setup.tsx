import "antd/dist/antd.css";
import "../assets/admin/css/common.css";

class Setup {
  public static bootstrap() {
    // Setup environment
    window.Cominovel = window.Cominovel || {};
    window.Cominovel.currentID  = window.Cominovel.currentID || 14395; // This line is trick use for develop
  }
}

export default Setup;
