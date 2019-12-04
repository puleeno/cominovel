import { AnyAction } from "redux";
import { FETCH_COMINOVEL_FULLFILLED } from "../actions/types";
import { ICominovelData } from "../interfaces/CominovelProps";

export interface ICominovelState {
    info: ICominovelData;
}

const initState: ICominovelState = {
    info: {
        ID: 0,
        alternative_name: "",
        audult: "",
        author: "",
        badge: "",
        chapters: [],
        cmn_artist_terms: [],
        cmn_author_terms: [],
        cmn_country_terms: [],
        cmn_release_terms: [],
        cmn_status_terms: [],
        genre_terms: [],
        parent: 0,
        post_content: "",
        post_excerpt: "",
        post_modified: "",
        post_name: "",
        post_parent: 0,
        post_status: "",
        post_title: "",
        post_type: "",
        rating_system: "",
        season: "",
        short_description: "",
    },
};

export function cominovelInfo(previewState: ICominovelState = initState, action: AnyAction): ICominovelState {
    switch (action.type) {
        case FETCH_COMINOVEL_FULLFILLED: {
            const newState = {
                ...previewState,
                info: action.payload,
            };
            return newState;
        }
        default: {
            return previewState;
        }
    }
}
