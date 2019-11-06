export interface IEndpoint {
    GetComic: string;
    GetNovel: string;
}

export interface ICominovelProps {
    currentID: number;
    endpoints: IEndpoint[];
    languages: any;
    messages: any;
}

export interface ICominovelData {
    ID: number;
    alternative_name: string;
    artist: string;
    audult: string;
    author: string;
    badge: string;
    chapters: any;
    generes: string;
    parent: number;
    post_content: string;
    post_excerpt: string;
    post_modified: any;
    post_name: string;
    post_parent: number;
    post_status: string;
    post_title: string;
    post_type: string;
    release: string;
    seasons: string;
    short_description: string;
    status: string;
    type: string;
}

export interface ISeason {
    id: number;
    name: string;
}
