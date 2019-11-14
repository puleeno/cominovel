import { combineEpics } from "redux-observable";

import fetchCominovel from "./cominovelEpics";
import { fetchTaxonomyTerms } from "./cominovelTaxonomies";
import { getCominovelSeasonsViaAjax } from "./seasonEpics";

export default combineEpics(
  fetchCominovel,
  getCominovelSeasonsViaAjax,
  fetchTaxonomyTerms,
);
