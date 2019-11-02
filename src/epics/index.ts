import { combineEpics } from "redux-observable";
import fetchCominovel from "./Cominovel";

export default combineEpics(
  fetchCominovel,
);
