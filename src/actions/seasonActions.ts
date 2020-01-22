import { ISeason } from "../interfaces/CominovelProps";
import { FETCH_SEASONS, FETCH_SEASONS_FULLFILLED, UPDATE_SEASONS } from "./types";

export function fetchSeasons(postId: number) {
  return {
      payload: postId,
      type: FETCH_SEASONS,
  };
}

export function fetchSeasonsFullFilled(seasons: ISeason[]) {
    return {
        payload: seasons,
        type: FETCH_SEASONS_FULLFILLED,
    };
}

export function updateSeasons(seasons: any, postId: number) {
  return {
    payload: {
      postId,
      seasons,
    },
    type: UPDATE_SEASONS,
  };
}
