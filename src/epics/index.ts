import { combineEpics } from "redux-observable";

import fetchCominovel from "./cominovelEpics";
import { fetchTaxonomyTerms } from "./cominovelTaxonomies";
import { getCominovelSeasonsViaAjax, updateCominovelSeasons } from "./seasonEpics";

export default combineEpics(
  fetchCominovel,
  fetchTaxonomyTerms,
  getCominovelSeasonsViaAjax,
  updateCominovelSeasons,
);
