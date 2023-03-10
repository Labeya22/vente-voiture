/**
 * 
 * @param {string} url 
 * @returns {string|Promise<any>}
 */
export async function fetchJson(url) {
    const r = await fetch(url)
    if (r.ok) {
        return r.json()
    }
    throw new Error("une erreur est survenue")
}

export async function fetchPostJson(url, body) {
    const r = await fetch(url, { method: 'POST', body})
    if (r.redirected) return null
    if (r.ok) return r.json()
    throw new Error("une erreur est survenue")
}

export async function fetchText(url) {
    const r = await fetch(url)
    if (r.ok) return r.text()
    throw new Error("une erreur est survenue")
}



export async function fetchTextPost(url, body) {
    const r = await fetch(url, { method: 'POST', body})
    if (r.ok) return r.text()
    throw new Error("une erreur est survenue")
}
