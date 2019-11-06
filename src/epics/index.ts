import { combineEpics } from "redux-observable";

import fetchCominovel from "./cominovelEpics";
import { getCominovelSeasonsViaAjax } from "./seasonEpics";

export default combineEpics(
  fetchCominovel,
  getCominovelSeasonsViaAjax,
);
