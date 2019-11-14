import {
    FETCH_COMINOVEL,
    FETCH_COMINOVEL_FULLFILLED,
    FETCH_TAXONOMY_TERMS,
} from "./types";

export function fetchCominovel(id: number) {
    return {
        payload: id,
        type: FETCH_COMINOVEL,
    };
}

export function fetchCominovelData(payload: any) {
    return {
        payload,
        type: FETCH_COMINOVEL_FULLFILLED,
    };
}

export function fetchTaxonomyTerms(
    taxonomy: string = "genre",
    keyword: string | null = null,
    treeView: boolean = true,
) {
    return {
        keyword,
        taxonomy,
        treeView,
        type: FETCH_TAXONOMY_TERMS,
    };
}
